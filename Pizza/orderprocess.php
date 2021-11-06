<?php
    //this is the page that is going to process the pizza order
    $page = "Order Recipt";
    $path = './';
    include $path. 'assets/inc/header.php';
?>

<h2>your pizza order</h2>

<?php
    //$_SERVER
    var_dump($_POST); //dumps out the entire value of the array
    $cn = $_POST['customerName'];
    $cid = $_POST['customerID'];
    $ps = $_POST['pizzaSize'];

    if(empty($cid))
    {
        //no custumer id! Chuck them back!
        header('Location: orderform.php?name='.$cn);
    }
    else
    {
        //process order

        //assume all of our data is good...
        switch($ps)
        {
            case 'P':
                $cost = 7.99;
                $type = "Perosnal";
                break;
            case 'S':
                $cost = 10.99;
                $type = "Small";
                break;
            case 'S':
                $cost = 13.99;
                $type = "Medium";
                break;
            case 'S':
                $cost = 16.99;
                $type = "Large";
                break;
            default:// if nothing matches
                $cost = 16.99;
                $type = "Large";
                break;
        }
        //calculate the tax
        $tax = $cost *0.08;
        $tot = $cost + $tax;

        //output...
        //good way to set the monetary output
        setLocale(LC_MONETARY,'en_US'); //try "it_IT"

    ?>
        <!-- in htm;, that would ony come out if the php has $cid-->
            <h4>Welcome back, <?php echo$_POST['customerName'];?> - we have missed you</h4>
            <div>
                Your delicilous pizza
                <br/>
                Price:
                <?php
                    echo money_format('%(#6n', $cost);
                    echo '<br/> tax amount: '.money_format('%(#6n', $tax);
                    echo '<br/> Total amount: '.money_format('%(#6n', $cost);
                    echo ' for you'.$type.'pizza' .$cn.'!';
                ?>
            </div>
        <?php

    }

    echo '<h4>Weclome back, '.$_POST['customerName'].' - we have missed you</h4>';
?>

<?php
	include $path.'assets/inc/footer.php';
?>
