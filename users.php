<?php $title = "Users"; include("php/head.php"); 

$total_results = $pdo->query("SELECT COUNT(*) as total FROM users")->fetchColumn();

?>

<div>
    <h3 class="font-weight-light mb-2" style="float: left;">Users (<?=number_format($total_results);?>)</h3>
</div>
<form method="post" action="" _lpchecked="1">
    <center>
        <div id="SearchBar" class="SearchBar">
            <div class="input-group"><input name="search" type="text" placeholder="Search"
                    class="form-control text-black">
                <div class="input-group-append"><button type="submit" class="btn btn-secondary btn-md" name=""><i
                            aria-hidden="true" class="fas far fa-search"></i></button></div>
            </div>
        </div>
    </center>
</form>
<div class="mb-2"></div>
</div>
<main class="pt-3 container">
    <?php
    $results_per_page = 15;

    $total_pages = ceil($total_results / $results_per_page);

    if (!isset($_GET['page'])) {
        $current_page = 1;
    } else {
        $current_page = $_GET['page'];
    }

    $offset = ($current_page - 1) * $results_per_page;

    $stmt = $pdo->prepare("SELECT * FROM users LIMIT :offset, :results_per_page");
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':results_per_page', $results_per_page, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<div class="container"><div class="row">';
    foreach ($result as $user) {
        echo '<div class="col-md-4 mb-4">
            <a href="/user/'.$user['id'].'" class="text-light" style="text-decoration: none !important;"><div class="card h-100" style="text-align: center;">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa fa-circle" style="font-size: 1ch; position: relative; bottom: 2pt; color: grey;"></i> ' . $user['username'] . '</h5>
                    <p class="card-text"><img src="https://goblox.space/images/NewFrontPageGuy.png" style="height: 10rem;"></p>
                    <p class="card-text text-muted">Placeholder</p>
                </div>
            </div></a>
        </div>';
    }
    echo '</div></div>';

    if ($total_pages > 1) {
        echo '<div class="container"><nav><ul class="pagination justify-content-center">';
        if ($current_page > 1) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">&laquo;</a></li>';
        }

        if ($current_page > 3) {
            echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
            if ($current_page > 4) {
                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
        }

        for ($i = max(1, $current_page - 2); $i <= min($current_page + 2, $total_pages); $i++) {
            if ($i == $current_page) {
                echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
            }
        }

        if ($current_page < $total_pages - 2) {
            if ($current_page < $total_pages - 3) {
                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
            echo '<li class="page-item"><a class="page-link" href="?page=' . $total_pages . '">' . $total_pages . '</a></li>';
        }

        if ($current_page < $total_pages) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">&raquo;</a></li>';
        }
        echo '</ul></nav></div>';
    }
    ?>
</main>
</div>
</div>
</div>
<?php include("php/footer.php"); ?>
