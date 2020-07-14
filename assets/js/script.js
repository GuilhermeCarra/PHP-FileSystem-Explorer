

window.addEventListener("contextmenu", function (event) {
    event.preventDefault();
    var contextElement = document.getElementById("rightclick-menu");
    contextElement.style.top = event.offsetY + "px";
    contextElement.style.left = event.offsetX + "px";
    contextElement.classList.add("menu-active");
});
window.addEventListener("click", function () {
    document.getElementById("rightclick-menu").classList.remove("menu-active");
});


Array.prototype.forEach.call(
    document.querySelectorAll(".file-upload__button"),
    function(button) {
      const hiddenInput = button.parentElement.querySelector(
        ".file-upload__input"
      );
      const label = button.parentElement.querySelector(".file-upload__label");
      const defaultLabelText = "No file(s) selected";
  
      // Set default text for label
      label.textContent = defaultLabelText;
      label.title = defaultLabelText;
  
      button.addEventListener("click", function() {
        hiddenInput.click();
      });
  
      hiddenInput.addEventListener("change", function() {
        const filenameList = Array.prototype.map.call(hiddenInput.files, function(
          file
        ) {
          return file.name;
        });
  
        label.textContent = filenameList.join(", ") || defaultLabelText;
        label.title = label.textContent;
      });
    }
  );

  document.getElementById("logofile").addEventListener("click",function(){
      location.reload();
  });

  

  // TIME TO FINISH
/* Timer to finish 
setTimeout(fade_out, 5000);

 function fade_out() {
  $(".file-upload__label").fadeOut().empty();
} */ 



var actualDir;

$("#root").data("path", "My Files/").click(changeFolder);

function changeFolder() {
    actualDir = $(event.target).data("path");
    $.get({
        type: 'POST',
        url: 'filesFunctions.php',
        data: ({
            operation: "showFolder",
            actualDir: actualDir
        }),
        success: function (php_script_response) {
            console.log(php_script_response);
            $('#folder').empty();
            var folderContent = php_script_response;
            var dirs = JSON.parse(folderContent)[0];
            var files = JSON.parse(folderContent)[1];
            files = JSON.parse(files);
            dirs = JSON.parse(dirs);
            for (let i = 0; i < Object.keys(dirs).length; i++) {
                let folder = '<li>' + dirs[i] + '</li>"'
                $('#folder').append($(folder)
                    .data("path", actualDir + dirs[i] + "/")
                    .click(changeFolder));
            }
            for (let i = 0; i < Object.keys(files).length; i++) {
                let file = '<li>' + files[i] + '</li>"'
                $('#folder').append($(file)
                    .data("path", actualDir + files[i])
                    .click(fileClicked));
            }
        }
    });
}

function fileClicked() {
    console.log($(event.target).data("path"));
}