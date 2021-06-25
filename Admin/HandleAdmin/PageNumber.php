<style>
    .page-link-item{
        color: black;
        padding: 5px 10px;
        font-size: 20px;
        margin: 5px;
        text-decoration: none;
        border: 1px solid #B0E0E6;
    }
    .page-link-item:hover{
        background-color: #dddada;
    }
    .page-link-item.active{
        color: white;
        background-color: gray;
    }
</style>
    <?php
    for($num = 1 ; $num <= $totalpage; $num++){
        if($totalpage <= 1){
            break;
        }
        if($curren_page != $num){
            ?>
            <a class="page-link-item" href="?page=<?php echo $num ?>"><?php echo $num ?></a>
            <?php
        } else {
            ?>
            <a class="page-link-item active" href="?page=<?php echo $num ?>"><?php echo $num ?></a>
            <?php
        }
        
    }

