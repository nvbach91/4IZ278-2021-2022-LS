window.onload = () => {
	setArticleSize();
};

function setArticleSize() {
	let imgSize = document.querySelector(".articles-list img").getBoundingClientRect().width * 0.83;

	let allDivs = document.querySelectorAll(".articles-list div");
	let allImages = document.querySelectorAll(".articles-list img");
	allImages.forEach((el) => {
		el.style.height = imgSize + "px";
		console.log(el.getBoundingClientRect().width);
	});

	allDivs.forEach((el) => {
		el.style.height = imgSize + "px";
		console.log(el.getBoundingClientRect().width);
	});
}

function openArticle(article) {
	location.href = `./article/${article}.html`;
}
