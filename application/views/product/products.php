
<table border="1px">
    <tr>
        <th>Name</th>
        <th>price</th>
        <th></th>
    </tr>
<?php foreach ($products as $product) { ?>
    <tr>
        <td><?php echo $product['name'] ?></td>
        <td><?php echo $product['price'] ?></td>
        <td><a href="<?php echo base_url() ?>cart/addToCart/<?php echo $product['id'] ?>">add to cart</a>
    </tr>
        
<?php } ?>
    

</table>

<?php foreach ($links as $link) {
    echo $link." ";
} ?>

<a href="<?php echo base_url() ?>cart/displayCart/">Display Cart</a>


