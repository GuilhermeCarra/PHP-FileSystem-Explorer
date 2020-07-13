var actualDir = "My Files/";

$("#root").click(changeFolder);

function changeFolder() {
    $.get({
        type: 'POST',
        url: 'filesFunctions.php',
        data: ({operation: "showFolder", actualDir: actualDir}),
        success: function(php_script_response){
            var folderContent = php_script_response;
            var dirs = JSON.parse(folderContent)[0];
            var files = JSON.parse(folderContent)[1];
            files = JSON.parse(files);
            dirs = JSON.parse(dirs);
            for (let i = 0; i < Object.keys(dirs).length; i++){
                let folder = '<li id="root"><i class="fa fa-folder">'+dirs[i]+'</i></li>"'
                $('#folder').append($(folder).data("path",actualDir+dirs[i]));
            }
            for (let i = 0; i < Object.keys(files).length; i++){
                let file = '<li id="root"><i class="fa fa-file">'+files[i]+'</i></li>"'
                $('#folder').append($(file).data("path",actualDir+files[i]));
            }
        }
    });
}
