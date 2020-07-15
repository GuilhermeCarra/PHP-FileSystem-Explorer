<!DOCTYPE html>
<html lang="en">

<head>
    <title>File System</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Own stylesheet -->
    <link rel="stylesheet" href="assets/style/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-light bg-header">
            <a class="navbar-brand">
                <img src="assets/img/file-system-icon-28.jpg" class="mb-2" id="logofile" height="40px" width="40px">
                <text class="logo-text mt-1">FS</text>
            </a>
            <div class="form-inline">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                <input class="file-upload__input" type="file" name="myFile[]" id="myFile" multiple>
                <i class="fa fa-download ml-3 file-upload__button" type="button"></i>
                <span class="file-upload__label ml-1"></span>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="file-manager">
                            <div class="hr-line-dashed"></div>
                            <button class="btn btn-primary btn-block" id="newFolderModalBtn" data-toggle="modal" data-target="#newfolderModal">New Folder</button>
                            <div class="hr-line-dashed"></div>
                            <h5>Folders</h5>
                            <ul class="folder-list" style="padding: 0">
                                <li id="root"><i class="fa fa-folder"></i>My Files</li>
                                <li id="delete" class="mt-2"><i class="fa fa-trash"></i>Trash</li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-light bg-light">
                            <a class="navbar-brand ml-1">Name</a>
                            <form class="form-inline">
                                <a class="navbar-brand mr-4">Size</a>
                            </form>
                        </nav>
                        <ul class="list-unstyled" id="folder" >
                            <!-- Archives / Folder printed dynamically -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-none" id="details-file">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="file-manager">
                            <div class="hr-line-dashed"></div>
                            <img src="" id="detail-icon" height="35px" width="35px">
                            <span class="h5" id="detail-name"></span>
                            <div class="hr-line-dashed"></div>
                            <h4 class="information mt-4">Type: <strong id="detail-type" class="small"></strong></h4>
                            <h4 class="information mt-4">Size: <strong id="detail-size" class="small"></strong></h4>
                            <h4 class="information mt-4">Modified: <strong id="detail-mod" class="small"></strong></h4>
                            <h4 class="information mt-4">Created: <strong id="detail-creat" class="small"></strong></h4>
                            <div class="information mt-4 d-none" id="details-preview"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Right click menu -->
        <div id="rightclick-menu">
            <div class="item" id="rightClickCut">
                <i class="fa fa-cut"></i> Cut
            </div>
            <div class="item" id="rightClickCopy">
                <i class="fa fa-copy"></i> Copy
            </div>
            <div class="item" id="rightClickPaste">
                <i class="fa fa-paste"></i> Paste
            </div>
            <div class="item" id="rightClickRemove">
                <i class="fa fa-trash-o" ></i> Remove
            </div>
            <div class="item" id="rightClickRename">
                <i class="fa fa-font"></i> Rename
            </div>
        </div> <!-- Right click menu -->

        <!-- New Folder Modal -->
        <div class="modal fade" id="newfolderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create New Folder</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="fname">Name: </label>
                        <input type="text" id="fname" name="fname">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="createFolderBtn">Create</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rename file Modal -->
        <div class="modal fade" id="renameFileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rename File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6 class="mb-3">File name: <strong id="oldNameRenameModal"></strong></h6>
                        <label for="fnewname">New Name: </label>
                        <input type="text" id="fnewname" name="fnewname">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="renameFileBtn">Rename</button>
                    </div>
                </div>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script src="assets/js/script.js"></script>
</body>

</html>