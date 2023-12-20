require('dotenv').config()

const express = require('express')
const app = express()
app.use(express.json())
app.use(express.static("public"))

const stripe = require('stripe')(process.env.STRIPE_PRIVATE_KEY)

const storeItems = new Map([
    [1, { priceInCents: 10000, name: 'Brown Leather Jacket'}],
    [2, { priceInCents: 8500, name: 'Brown Dress'}],
    [3, { priceInCents: 2500, name: 'Brown Shirt'}],
    [4, { priceInCents: 4000, name: 'Brown Leather Pants'}],
    [5, { priceInCents: 4100, name: 'Brown Leather Skirt'}],
    [6, { priceInCents: 2500, name: 'Brown Coat'}],
    [7, { priceInCents: 7100, name: 'Brown Swimsuit'}],
])


app.post('/create-checkout-session', async (req, res) => {
    try {
        const session = await stripe.checkout.sessions.create({
            payment_method_types: ['card'],
            mode: 'payment',
            line_items: req.body.items.map(item => {
                const storeItem = storeItems.get(item.id)
                return {
                    price_data: {
                        currency: 'aud',
                        product_data: {
                            name: storeItem.name
                        },
                        unit_amount: storeItem.priceInCents
                    },
                    quantity: item.quantity,
                }
            }),
            success_url: '${process.env.SERVER_URL}/payment-success.html',
            cancel_url: '${process.env.SERVER_URL}/payment-error.html',
        })
    res.json({ url: session.url })
    } catch (e) {
        res.status(500).json({ error: e.message })
    }
})

app.listen(3000)