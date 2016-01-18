function save() {
	var bone = $("#bone").val();

	if ((bone == undefined) || (bone == "")) {
		return;
	}
	else {
		$.post("data/bone.php", { action: "save", bone: bone, crypt: false }, function(data) {
			window.location.href = "./" + data;
		});
	}
}

function openCrypt() {
	$(".modal").show();
	$("#password-modal-crypt").show();
}

function crypt() {
	var bone = $("#bone").val();
	var password = $("#crypt-password").val();

	if ((bone == undefined) || (bone == "")) {
                return;
        }
        else {
		bone = sjcl.codec.base64.fromBits(sjcl.codec.utf8String.toBits(sjcl.encrypt(password, bone, { ks: 256 })))

		$.post("data/bone.php", { action: "save", bone: bone, crypt: true }, function(data) {
                        window.location.href = "./" + data;
                });
        }
}

function decrypt() {
	var bone = $("#bone").val();
	var password = $("#decrypt-password").val();

	if ((bone == undefined) || (bone == "")) {
                return;
        }
        else {
			bone = sjcl.decrypt(password, sjcl.codec.utf8String.fromBits(sjcl.codec.base64.toBits(bone)), { ks: 256 });
			
			$(".modal").hide();
			$(".password").hide();

	        $("#bone").val(bone);
        }
}

function raw(bin) {
	window.location.href = "./raw" + bin;
}
