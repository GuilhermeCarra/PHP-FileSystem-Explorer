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
            <a class="navbar-brand">FL</a>
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
                            <button class="btn btn-primary btn-block">New</button>
                            <div class="hr-line-dashed"></div>
                            <h5>Folders</h5>
                            <ul class="folder-list" style="padding: 0">
                                <li id="root"><i class="fa fa-folder"></i>My Files</li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12" id="folder">
                        <nav class="navbar navbar-light bg-light">
                            <a class="navbar-brand ml-5">Name</a>
                            <form class="form-inline">
                                <a class="navbar-brand mr-5">Size</a>
                            </form>
                        </nav>
                        <ul class="list-unstyled">
                            <li class="media">
                                <img src="assets/img/excel-2.png" class="mr-3 ml-1 mt-2 mb-1" alt="..." height="50px"
                                    width="50px">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1 mt-3">List-based media object</h5>
                                </div>
                            </li>
                            <li class="media my-4">
                                <img src="assets/img/excel-2.png" class="mr-3 ml-1 mt-2 mb-1" alt="..." height="50px"
                                    width="50px">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1 mt-3">List-based media object</h5>
                                </div>
                            </li>
                            <li class="media">
                                <img src="assets/img/excel-2.png" class="mr-3 ml-1 mt-2 mb-1" alt="..." height="50px"
                                    width="50px">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1 mt-3">List-based media object</h5>
                                </div>
                            </li>
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