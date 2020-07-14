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
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand">
                <img src="assets/img/file-system-icon-28.jpg" height="40px" width="40px"> FL
            </a>
            <form class="form-inline d-left">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                <i class="fa fa-download ml-3"></i>
            </form>
        </nav>
        <div class="row">
            <div class="col-md-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="file-manager">
                            <div class="hr-line-dashed"></div>
                            <button class="btn btn-primary btn-block" data-toggle="modal"
                                data-target="#exampleModal">New Folder</button>
                            <div class="hr-line-dashed"></div>
                            <h5>Folders</h5>
                            <ul class="folder-list" style="padding: 0">
                                <li id="root"><i class="fa fa-folder"></i>My Files</li>
                                <li id="delete"><i class="fa fa-trash"></i>Trash</li>
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
                            <a class="navbar-brand">Name</a>
                            <form class="form-inline">
                                <a class="navbar-brand">Size</a>
                            </form>
                        </nav>
                        <ul class="list-unstyled" id="folder">
                            <!-- Archives / Folder printed dynamically -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="file-manager">
                            <div class="hr-line-dashed"></div>
                            <img src="assets/img/excel-2.png" class="" alt="..." height="35px" width="35px"> Excel.xls
                            <div class="hr-line-dashed"></div>
                            <p class="information">Type: </p>
                            <p class="information">Size: </p>
                            <p class="information">Modified: </p>
                            <p class="information">Created: </p>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="rightclick-menu">
            <div class="item">
                <i class="fa fa-cut"></i> Cut
            </div>
            <div class="item">
                <i class="fa fa-copy"></i> Copy
            </div>
            <div class="item">
                <i class="fa fa-paste"></i> Paste
            </div>
            <div class="item">
                <i class="fa fa-trash-o"></i> Remove
            </div>
            <div class="item">
                <i class="fa fa-font"></i> Rename
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <button type="button" class="btn btn-primary">Create</button>
                    </div>
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