window.onload = () => {
	setArticleSize();
};

function setArticleSize() {
	let imgSize = document.querySelector(".services-list img").getBoundingClientRect().width;

	let allDivs = document.querySelectorAll(".services-list img");
	let allImages = document.querySelectorAll(".services-list div");
	allImages.forEach((el) => {
		el.style.height = imgSize + "px";
	});

	allDivs.forEach((el) => {
		el.style.height = imgSize + "px";
	});
}

function openService(service) {
	location.href = `../service/${service}.html`;
}
