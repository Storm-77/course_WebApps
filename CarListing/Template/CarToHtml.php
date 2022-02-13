<?php
function CarToHtml($row)
{
    $id = $row['Id'];
    $thumbnailUrl = "Endpoints/Thumbnail.php?id=$id";
    $picturelUrl = "Endpoints/Picture.php?id=$id";
?>

    <div class="row mb-2">
        <div class="col-md-12 text-center">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-primary"><?php echo $row['Brand']; ?></strong>
                    <h3 class="mb-4"><?php echo $row['Model']; ?></h3>
                    <p class="card-text mb-auto text-muted"><?php echo $row['Year']; ?></p>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <a href="<?php echo $picturelUrl; ?>">
                        <img src="<?php echo $thumbnailUrl ?>" width="500" alt="This entry has no thmbnail">
                    </a>                   
                </div>
            </div>
        </div>
    </div>

<?php
}
?>