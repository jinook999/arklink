<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/vs2015.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100..900&display=swap" rel="stylesheet">
<style>
code { font-family: "Noto Sans KR", sans-serif !important; font-optical-sizing: auto; font-style: normal; font-size: 14px; height: 700px; }
#btn-submit, #btn-close { padding: 6px 30px; background: #000; color: #fff; border: 1px solid #000; cursor: pointer; }
#btn-close { background: #fff; color: #000; border: 1px solid #000; }
.center { text-align: center; }
</style>
<script src="/lib/js/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<script>
$(function() {
	hljs.highlightAll();

	$("#btn-submit").on("click", function() {
		if(confirm("메일 내용이 수정됩니다.\n수정하시겠습니까?")) {
			let content = $("code").text();
			content = content.replace(/\t/g, "\\t");
			content = content.replace(/&/g, "&amp;");
			content = content.replace(/</g, "&lt;");
			content = content.replace(/>/g, "&gt;");
			$("#content").val(content);
			$("#e-form").submit();
		}
	});
});
</script>
<div id="code" contentEditable="true"><pre><code class="language-html"><?=htmlentities($body)?></code></pre></div>
<div class="center">
	<button id="btn-submit">수정</button>
	<button id="btn-close" onclick="window.close()">닫기</button>
</div>
<form id="e-form" action="update_content" method="post" style="display: none;">
	<input type="text" name="skin" value="<?=$skin?>"><br>
	<textarea name="content" id="content" style="width: 100%; height: 800px;"></textarea>
</form>