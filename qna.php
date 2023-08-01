<?php
include 'db.php;
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>free</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body class="bg-dark">
    <div class="container-fluid mt-3">
        <div class="card" style="height:1000px;">
            <div class="card-header text-center">
                <h1>Welcome my blog</h1>
            </div>
            <div class="card-body">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                   <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="free.php">free</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="inform.php">inform</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="qna.php">Q&A</a>
                            </li>
                        </ul>
                    </div>
                    <form class="justify-content-end">
                        <?php 
                            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']==TRUE) {
                                echo $_SESSION['email']." - <a href='logout.php' class='btn btn-danger'>LOGOUT</a>";
                            }else{
                                echo "<button type='button' class='btn btn-success m-1' data-bs-toggle  ='modal' oclick=\"location.href='login.php'\">Login</button>
                                <button type='button' class='btn btn-danger m-1' data-bs-toggle='modal' oclick=\"location.href='register.php'\">Register</button>";
                            }
                         ?>
                    </form>
                </nav>
                <div id="board_area"> 
                    <h1>QnA</h1>
                    <table class="list-table">
                        <thead>
                            <tr>
                                <th width="70">번호</th>
                                <th width="500">제목</th>
                                <th width="120">글쓴이</th>
                                <th width="100">조회수</th>
                            </tr>
                        </thead>
                        <a href="qna_write.php"><button>글쓰기</button></a>

                        <?php
                        while ($board = $result->fetch_array()) {
                            $title = $board["title"];
                            if (strlen($title) > 30) {
                                $title = str_replace($board["title"], mb_substr($board["title"], 0, 30, "utf-8") . "...", $board["title"]);
                            }
                        ?>
                        <tbody>
                            <tr class="list_board">
                                <td width="70"><?php echo $board['idx']; ?></td> 
                                <td width="500">
                                    <?php 
                                    $lockimg = "<img src='/img/lock.png' alt='lock' title='lock' with='20' height='20' />";
                                    if ($board['lock_post'] == "1") {
                                        echo $lockimg;
                                    }
                                    ?><a href="qna_detail.php?idx=<?php echo $board["idx"]; ?>"><?php echo $title; ?></a></td>
                                <td width="120"><?php echo $board['name'] ?></td>
                                <td width="100"><?php echo $board['view']; ?></td>
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                    <?php
                    if ($is_user) {
                    ?>
                    <div id="write_btn">
                    </div>
                    <?php } ?>
                </div>
                <div id="search_box">
                    <form action="qna_board_search.php" method="get">
                        <select name="search_option">
                            <option value="title">제목</option>
                            <option value="name">작성자</option>
                            <option value="content">내용</option>
                        </select>
                        <input type="text" name="search" size="40" required="required" /> <button>검색</button>
                    </form>
                </div>
                <a href="index.php"><button>메인화면으로</button></a>
            </div>
        </div>
    </div>
</body>
</html>
