var toolbarOptions = [
	["bold"], // toggled buttons
	[{ list: "ordered" }, { list: "bullet" }],
	[{ header: [3, false] }],
	["clean"], // remove formatting button
];

var quill = new Quill("#editor", {
	modules: {
		toolbar: toolbarOptions,
	},
	theme: "snow",
});

// document.getElementById("btnUpload").onclick = () => {
// 	let text = quill.root.innerHTML;
// 	document.getElementById("inputContent").value = text;

// };

$(document).ready(function () {
	$("#formArticle").on("submit", function () {
		let text = quill.root.innerHTML;
		$(this).append("<input type='hidden' name='hello' value=' " + text + " '/>");
	});
});
