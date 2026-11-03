<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>MedexHub - PayPal Checkout</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm mx-auto"
         style="max-width: 480px;">

        <div class="card-body p-4">
            <h3>MedexHub Payment</h3>

            <p>Exam Access</p>

            <h2>AUD $49.99</h2>

            @if ($errors->has('paypal'))
                <div class="alert alert-danger">
                    {{ $errors->first('paypal') }}
                </div>
            @endif

            <form action="{{ route('paypal.pay') }}" method="POST">
                @csrf
                <input type="hidden" name="InvoiceId" value="2"> 
                <input type="hidden" name="ExamId" value="3"> 
                <input type="hidden" name="PayFor" value="2"> 
                <input type="hidden" name="PurchaseType" value="2"> 
                <input type="hidden" name="AmountTotal" value="4000.00"> 
                <input type="hidden" name="AmountDiscount" value="500.00"> 
                <input type="hidden" name="AmountPayable" value="3500"> 
                <button type="submit"
                        class="btn btn-primary w-100">
                    Pay securely with PayPal
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>