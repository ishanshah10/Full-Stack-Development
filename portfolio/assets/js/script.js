function updateStock(productId, change) {

    let stockElement = document.getElementById("stock-" + productId);
    let currentStock = parseInt(stockElement.innerText);

    let newStock = currentStock + change;

    if (newStock < 0) {
        alert("Stock cannot go below 0");
        return;
    }

    var xhr = new XMLHttpRequest();

    xhr.open("POST", "ajax_update_stock.php", true);

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            stockElement.innerText = xhr.responseText;
        }
    };

    xhr.send("id=" + productId + "&stock=" + newStock);
}

document.addEventListener("DOMContentLoaded", function () {

    let nameInput = document.getElementById("nameSearch");
    let supplierSelect = document.getElementById("supplierSearch");
    let minPrice = document.getElementById("minPrice");
    let maxStock = document.getElementById("maxStock");

    function liveSearch() {

        let name = nameInput.value;
        let supplier = supplierSelect.value;
        let price = minPrice.value;
        let stock = maxStock.value;

        var xhr = new XMLHttpRequest();

        xhr.open("POST", "ajax_search.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("resultArea").innerHTML = xhr.responseText;
            }
        };

        xhr.send(
            "name=" + name +
            "&supplier=" + supplier +
            "&min_price=" + price +
            "&max_stock=" + stock
        );
    }

    nameInput.addEventListener("keyup", liveSearch);
    supplierSelect.addEventListener("change", liveSearch);
    minPrice.addEventListener("keyup", liveSearch);
    maxStock.addEventListener("keyup", liveSearch);

});
