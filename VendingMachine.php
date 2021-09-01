<?php
$customer=new stdClass();
$customer->wallet=[
    1=>10,
    2=>10,
    5=>10,
    10=>10,
    20=>10,
    50=>10,
    100=>10,
    200=>10

];

function createCoffee(string $name,int $price):stdClass
{
    $coffee=new stdClass();
    $coffee->name=$name;
    $coffee->price=$price;

    return $coffee;
}
$products=[
    createCoffee('[0]Coffe',100),
    createCoffee('[1]Latte',170),
    createCoffee('[2]Expresso',120),
    createCoffee('[3]Tea',80),
    createCoffee('[4]Hot water',50),
    createCoffee('[5]Hot WODKA',500)

];
echo"PURCH Vendingmashine".PHP_EOL;
echo"_____________________________".PHP_EOL;
foreach ($products as $product)
{
    $price=$product->price /100;
    echo "{$product->name} for {$price}$".PHP_EOL;

}
echo"_____________________________".PHP_EOL;
$selection=(int)readline("Select your drink: ");
echo"_____________________________".PHP_EOL;
if(!isset($products[$selection]))
{echo"!!!!!!!!!".PHP_EOL;
    echo "Invalid product".PHP_EOL;
    echo"!!!!!!!!!".PHP_EOL;
    exit;
}
$selectedProduct =$products[$selection];
echo "Total ".$selectedProduct->price /100 .'$'.PHP_EOL;
echo"_____________________________".PHP_EOL;
$insertedCoins=0;

while($insertedCoins< $selectedProduct->price)
{
    echo "Total left to pay:".($selectedProduct->price -$insertedCoins)/100 . '$'.PHP_EOL;
    echo"_____________________________".PHP_EOL;
    $coin =(int)readline("Insert coins: ");

    if(!in_array($coin,array_keys($customer->wallet)))
    {
        echo"!!!!!!!!!".PHP_EOL;
        echo "Invalid coin".PHP_EOL;
        echo"!!!!!!!!!".PHP_EOL;
        continue;
    }
    if(isset($customer->wallet[$coin])&&$customer->wallet[$coin]<=0)
    {
        echo "Coins not found";
        continue;
    }
    $customer->wallet[$coin]-=1;
    $insertedCoins+=$coin;
}
if($insertedCoins> $selectedProduct->price)
{
    echo"_____________________________".PHP_EOL;
    echo "Vending machine returns: ".($insertedCoins-$selectedProduct->price )/100 . '$'.PHP_EOL;
    echo "Have a good day ".PHP_EOL;
    echo"_____________________________".PHP_EOL;
}
if($insertedCoins== $selectedProduct->price)
{
    echo"_____________________________".PHP_EOL;
    echo "Have a good day ".PHP_EOL;
        echo"_____________________________".PHP_EOL;
}

$return =$insertedCoins-$selectedProduct->price;
foreach (array_reverse(array_keys($customer->wallet)) as $coin)
{
    $quantity = intdiv($return,$coin);

    $customer->wallet[$coin]+=$quantity;
    $return -=$coin*$quantity;

}

echo $return;