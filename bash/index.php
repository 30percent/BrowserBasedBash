<html>
  <head>
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
    <script>
    function makeTable(arr){
      var html = "<h3>Available files:</h3>";
      html += "<ul>";
      arr.forEach(function(element){
        html += "<li><a href='#' class='scriptFile' id='";
        html += element;
        html += "'>";
        html += element;
        html += "</a></li>";
      });
      html += "</ul>";
      return html;
    };   
 function handleFileClick(name, user){
    $.ajax({
      type: "POST",
      url: "ajax/getscript.php",
      data: {
          "name": name,
              //"user": $("input#user").val(),
  "user":user
      },
      success: function (html) {
                  $("textarea#script").val(html);
                  $("input#title").val(name);
		//$("textarea#result").val(res[1]);
      }
    });
  };
    $( document ).ready(function() {
          $.ajax({
            type: "POST",
            url: "ajax/getfilelist.php",
            data: {
              "user":"mrtodd"
            },
            success: function(result) {
              $('#left').html(makeTable(JSON.parse(result)));

      $(".scriptFile").click(function(event){
        event.preventDefault();
        var name = $(this).attr("id");
	handleFileClick(name, "mrtodd");
      });
          }
          //dataType:"json"
          });
    });
    $(function () {
        $(".scriptButton").click(function () {
            // validate and process form here
            //$('.error').hide();
            var title = $("input#title").val();
            if (title == "") {
                $("label#title_error").show();
                $("input#title").focus();
                return false;
            }
            var user = $("input#user").val();
            user = "mrtodd";
            if (user == "") {
                $("label#user_error").show();
                $("input#user").focus();
                return false;
            }
            var script = $("textarea#script").val();
            if (script == "") {
                $("label#script_error").show();
                $("textarea#script").focus();
                return false;
            }
            $.ajax({
                type: "POST",
                url: "ajax/sendscript.php",
                data: {
                    "title": $("input#title").val(),
                        //"user": $("input#user").val(),
			"user":"mrtodd",
                        "script": $("textarea#script").val()
                },
                success: function (html) {
			$("textarea#result").val(html);
			var newTitle = $("input#title").val()
			newTitle = newTitle.replace(/[^a-z0-9\s.-]/gi, '');
			console.log(newTitle);
                }
            });
            return false;
        });
    });
    </script>
  </head>
  <body>
    <div id="left" class="sidebar">
hello
    </div>
    <script>
    </script>
    <div id="scriptform">
      <form name="message" action='' method='post'>
        <input type="text" placeholder="Script Name" id="title" required>
        <label class="error" for="name" id="title_error" style="display: none;">This field is required.</label>
        <br /><!--<b>User:</b>
        <input type="hidden" id="user">
        <label class="error" for="name" id="user_error" style="display: none;">This field is required.</label>
     	<br />
	 -->
        <b>Message:</b>
        <textarea id='script' name='script' rows=20 cols=80 ></textarea>
        <label class="error" for="name" id="message_error" style="display: none;">This field is required.</label>
        <br />
        <button id="scriptButton" class="scriptButton" type="submit">Confirm</button>
      </form>
    </div>
	<div id="output">
		<textarea id="result" class="name" rows=15 cols=80></textarea>
	</div>
  </body>
</html>
