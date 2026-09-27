<!-- PayPal SDK -->
<script 
  src="https://www.paypal.com/sdk/js?client-id=BAAQePvJch8VJquVFOuHvsq9vi5aGRmqVvSeqjnhcnLFjrOIZ4G2dOwmBPAdNs-MdzhLGHSdqoJ7dY_gwo&components=hosted-buttons&disable-funding=venmo&currency=USD">
</script>

<!-- Container where the PayPal button will render -->
<div id="paypal-container-YOUR_HOSTED_BUTTON_ID"></div>

<script>
  paypal.HostedButtons({
    hostedButtonId: "YOUR_HOSTED_BUTTON_ID",
  }).render("#paypal-container-YOUR_HOSTED_BUTTON_ID");
</script>
