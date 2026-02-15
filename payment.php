<?php
require_once("./config.php");
include("./includes/header.php");

$esewaMerchantCode = getenv("ESEWA_MERCHANT_CODE") ?: "";
$khaltiPublicKey = getenv("KHALTI_PUBLIC_KEY") ?: "";
$paymentDemo = empty($esewaMerchantCode) || empty($khaltiPublicKey);

if (!isLoggedIn()) {
    header("Location: login.php");
}

if (!isset($_SESSION["reservation"])) {
    header("Location: reservation.php");
}

?>

<body>
    <?php include("./includes/navbar.php"); ?>
    <div class="container mt-5">
        <div class="row justify-content-between">
            <div class="col-md-5">
                <h1>Make your reservation</h1>
                <p>
                    Our hotel is self-certified to follow a series of
                    precautionary measures to make your hotel stay safe and
                    healthy.
                </p>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center justify-content-between">
                            <h3 class="text-xs-center mb-2">Payment Details</h3>
                            <div class="payment-badges">
                                <span class="payment-badge esewa">eSewa</span>
                                <span class="payment-badge khalti">Khalti</span>
                                <span class="payment-badge card">Card</span>
                            </div>
                        </div>
                    </div>
                    <form id="payment_form">
                        <div class="card-body">
                            <?php if ($paymentDemo) { ?>
                                <div class="alert alert-warning" role="alert">
                                    Payment gateways are not configured yet. You can continue to confirm the booking.
                                </div>
                            <?php } ?>
                            <div class="flex-row">
                                <div class="col-xs-12 ">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <div>
                                            <h2><b>$
                                                    <?= getRoomAmountFromId($_SESSION["reservation"]["room_id"], $pdo); ?></b>
                                                </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-row">
                                <div class="col-xs-12 ">
                                    <div class="form-group">
                                        <label>PAYMENT METHOD</label>
                                        <div class="payment-badges">
                                            <label class="payment-option">
                                                <input type="radio" name="payment_method" value="esewa" checked />
                                                <span class="payment-badge esewa">eSewa</span>
                                            </label>
                                            <label class="payment-option">
                                                <input type="radio" name="payment_method" value="khalti" />
                                                <span class="payment-badge khalti">Khalti</span>
                                            </label>
                                            <label class="payment-option">
                                                <input type="radio" name="payment_method" value="card" />
                                                <span class="payment-badge card">Card</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-row" id="gateway-credentials">
                                <div class="col-xs-12 ">
                                    <div class="form-group">
                                        <label>PAYMENT CREDENTIALS</label>
                                        <input type="text" class="form-control mb-2" name="esewa_merchant_code" placeholder="eSewa Merchant Code" />
                                        <input type="text" class="form-control" name="khalti_public_key" placeholder="Khalti Public Key" />
                                        <small class="text-muted">Enter your gateway credentials to proceed.</small>
                                    </div>
                                </div>
                            </div>
                            <div id="card-fields" style="display: none;">
                                <div class="flex-row">
                                    <div class="col-xs-12 ">
                                        <div class="form-group">
                                            <label>CARD NUMBER</label>
                                            <div class="input-group">
                                                <input type="tel" class="form-control" name="card_number" placeholder="Valid Card Number" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-7 col-md-7">
                                        <div class="form-group">
                                            <label><span class="hidden-xs">EXPIRATION</span><span
                                                    class="visible-xs-inline">EXP</span> DATE</label>
                                            <input type="tel" class="form-control" name="card_expiry" placeholder="MM / YY" />
                                        </div>
                                    </div>
                                    <div class="col-xs-5 col-md-5 float-xs-right">
                                        <div class="form-group">
                                            <label>CV CODE</label>
                                            <input type="tel" class="form-control" name="card_cvc" placeholder="CVC" />
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>CARD OWNER</label>
                                            <input type="text" class="form-control" name="card_owner" placeholder="Card Owner Names" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="flex-row">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-warning btn-lg btn-block">Proceed with payment</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include("./includes/footer.php"); ?>
    <script>
        $(document).ready(function () {
            $("nav").eq(0).addClass("bg-dark");
            $("nav").eq(0).addClass("navbar-dark");

            $("footer").eq(0).addClass("bg-dark");
            $("footer").eq(0).addClass("text-light");

            $("#payment_form").submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append("payment_method", $("input[name=payment_method]:checked").val());
                formData.append("confirm_booking", "confirm_booking");

                $.ajax({
                    url: "core/reservation_controller.php",
                    type: "POST",
                    data: formData,
                    success: function (data) {
                        if (data.error == 1) {
                            return;
                        }

                        let reservation_id = data.message.reservation_id;
                        window.location.href = "bill_view.php?reservation_id=" + reservation_id;
                    },
                    error: function (data, message, errorThrown) {
                        console.log(errorThrown);
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });

            $("input[name=payment_method]").on("change", function () {
                var method = $("input[name=payment_method]:checked").val();
                if (method === "card") {
                    $("#card-fields").show();
                    $("#gateway-credentials").hide();
                } else {
                    $("#card-fields").hide();
                    $("#gateway-credentials").show();
                }
            });
        });
    </script>
</body>

</html>