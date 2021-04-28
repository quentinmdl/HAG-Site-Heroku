 // Create an instance of the Stripe object with your publishable API key
 let stripe = Stripe('pk_test_51Ihi1LDDEk7YAvTOmOjvgXhizEs113FDWcbx0AcvWtg7WSXRnvFAozxLjeAqSoPG4YFgUwwAGnkxeahs7Twe8qOU00a75TbayW');

 document.getElementById("checkout-button-session").onclick = function() {
    // Create a new Checkout Session using the server-side endpoint you
    // created in step 3.
    fetch('/session-participer', {
        method: 'POST',
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(session) {
        return stripe.redirectToCheckout({ sessionId: session.id });
    })
    .then(function(result) {
        // If `redirectToCheckout` fails due to a browser or network
        // error, you should display the localized error message to your
        // customer using `error.message`.
        if (result.error) {
            alert(result.error.message);
        }
    })
    .catch(function(error) {
        console.error('Error:', error);
    });
 };