jQuery(document).ready(function () {

	jQuery('#qr_frm').on("submit", function(event){

		event.preventDefault();

		var formData = new FormData(this);
		var url = formData.get("url");
		var qrcode = new QRCode("qrcode", url);
		document.getElementById("qr_frm").reset();

		
	})
});