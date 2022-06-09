// window.onload = () => {
// 	window.location.reload(true);
// };
let scrollDisable = false;

function stopScrolling() {
	if (!document.getElementById("check").checked) {
		document.querySelector("nav").style.position = "fixed";
	} else {
		document.querySelector("nav").style.position = "relative";
	}
	if (!scrollDisable) {
		document.body.style.overflow = "hidden";
		document.body.style.touchAction = "none";
		scrollDisable = true;
	} else {
		document.body.style.overflow = "auto";
		document.body.style.touchAction = "auto";
		scrollDisable = false;
	}
}

function stopScrollingGallery() {
	if (!scrollDisable) {
		document.body.style.overflow = "hidden";
		scrollDisable = true;
	} else {
		document.body.style.overflow = "auto";
		scrollDisable = false;
	}
}
