<div class="col-md-3 col-lg-3 col-sm-4 col-xs-12 float-right-style">
    <div class="categories-menu mrg-xs">
        <div class="category-heading">
           <h3> Kategori Obat</h3>
        </div>
        <div class="category-menu-list">
            <ul>
                <?php $get = $myFunc->getKategori();?>
                <?php foreach ($get as $row): ?>
                    <li>
                        <a href="#">
                            <img src="<?= $baseurl ?>/images/cat_icon/<?= $row['icon'] ?>"> 
                            <?= $row['kategori'] ?>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</div>