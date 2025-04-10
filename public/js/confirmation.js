function togglePaymentForm(paymentMethod) {
    if (paymentMethod === 'paypal') {
        document.getElementById('paypal-form').style.display = 'block';
        document.getElementById('credit-card-form').style.display = 'none';
    } else if (paymentMethod === 'credit_card') {
        document.getElementById('paypal-form').style.display = 'none';
        document.getElementById('credit-card-form').style.display = 'block';
    }
}

function validateCardNumber(input) {
    var cardNumber = input.value.replace(/\D/g, '');
    var cardType = '';

    if (/^4[0-9]{12}(?:[0-9]{3})?$/.test(cardNumber)) {
        cardType = 'فيزا';
    } else if (/^5[1-5][0-9]{14}$/.test(cardNumber)) {
        cardType = 'ماستركارد';
    }

    if (isValidCardNumber(cardNumber)) {
        document.getElementById('card-type').innerText = cardType ? `نوع البطاقة: ${cardType}` : 'نوع البطاقة غير معروف';
        document.getElementById('donate-btn').disabled = false;
    } else {
        document.getElementById('card-type').innerText = 'رقم البطاقة غير صالح';
        document.getElementById('donate-btn').disabled = true;
    }
}

function isValidCardNumber(cardNumber) {
    var sum = 0;
    var shouldDouble = false;

    for (var i = cardNumber.length - 1; i >= 0; i--) {
        var digit = parseInt(cardNumber.charAt(i));

        if (shouldDouble) {
            digit *= 2;
            if (digit > 9) digit -= 9;
        }

        sum += digit;
        shouldDouble = !shouldDouble;
    }

    return sum % 10 === 0;



      // Toggle between PayPal and Credit Card Forms
      function togglePaymentForm(paymentMethod) {
        if (paymentMethod === 'paypal') {
            document.getElementById('paypal-form').style.display = 'block';
            document.getElementById('credit-card-form').style.display = 'none';
        } else if (paymentMethod === 'credit_card') {
            document.getElementById('paypal-form').style.display = 'none';
            document.getElementById('credit-card-form').style.display = 'block';
        }
    }

    // Validation and Form Submission
    document.getElementById('donate-btn').addEventListener('click', function(event) {
        // Validate form before submission
        if (formIsValid()) {
            document.querySelector('form').submit();  // Submit the form if valid
        } else {
            event.preventDefault();  // Prevent submission if there are errors
        }
    });

    // Function to validate form inputs
    function formIsValid() {
        // Here you can add your validation logic
        // For example, check if payment method is selected, card number is valid, etc.
        return true;  // For simplicity, assuming the form is valid.
    }

}

