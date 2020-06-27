 $(document).on( 'click', '.cart-btn-buy', function (e) {
     e.preventDefault();
     let idProduct = $(this).attr("data-id");
     $.ajax({
         type: 'POST',
         url: "/buy/" + idProduct,
         error: function (data) {
             alert('Ошибка связи. Перезагрузите страницу и повторите попытку.');
             console.log(data);
         },
         success: function (data) {
             if (typeof data != 'undefined')
             {
                 let obj = jQuery.parseJSON(data);
                 let cartItems = document.querySelector(".cart-items");
                 while (cartItems.firstChild) {
                     cartItems.removeChild(cartItems.firstChild);
                 }
                 let totalProductsCount = 0;
                 for (let i = 0; i < obj.length; i++) {
                     totalProductsCount += obj[i].count;
                     let cartItem = document.createElement('div');
                     cartItem.classList.add('cart-item');
                     cartItem.appendChild(getImgItem(obj[i]));
                     cartItem.appendChild(getH3Item(obj[i]));
                     cartItem.appendChild(getCostItem(obj[i]));
                     cartItem.appendChild(getCartCountPriceItem(obj[i]));
                     cartItem.appendChild(getBtnBuyItem(obj[i]));
                     cartItem.appendChild(getBtnRemoveItem(obj[i]));
                     cartItems.appendChild(cartItem);
                 }
                 if (totalProductsCount !== 0) {
                     $("#count-products-in-cart").html("(" + totalProductsCount + ")");
                 } else {
                     $("#count-products-in-cart").html('');
                 }
                 alert('Товар куплен');
             }else{
                 console.log("Произошла ошибка при выборе данных");
                 alert('Ошибка доступа к данным. Перезагрузите страницу и повторите попытку. Если ошибка будет повторяться, обратитесь к разработчику.');
             }
         }
     });
 });

 function getImgItem(obj) {
    let phoneImgItem = document.createElement('img');
    phoneImgItem.src = obj.image_path;
    phoneImgItem.alt = obj.name;
    phoneImgItem.width = 195;
    phoneImgItem.height = 195;
    return phoneImgItem;
}

function getH3Item(obj) {
    let phoneNameItem = document.createElement('h3');
    phoneNameItem.textContent = obj.name;
    return phoneNameItem;
}

function getCostItem(obj) {
    let costItem = document.createElement('b');
    costItem.classList.add('catalog-item-price');
    costItem.textContent = obj.cost + ' ₽';
    return costItem;
}

function getCartCountPriceItem(obj) {
    let cartSetCountAndPriceItem = document.createElement('div');
    cartSetCountAndPriceItem.classList.add('cart-set-count-and-price', 'clearfix');
    cartSetCountAndPriceItem.appendChild(getSetCountItem(obj));
    cartSetCountAndPriceItem.appendChild(getSetPriceItem(obj));
    return cartSetCountAndPriceItem;
}

function getSetCountSpanBItem(obj) {
    let setCountSpanBItem = document.createElement('b');
    setCountSpanBItem.textContent = obj.count;
    return setCountSpanBItem;
}

function getSetCountSpanItem(obj) {
    let setCountSpanItem = document.createElement('span');
    setCountSpanItem.textContent = 'Товаров: ';
    setCountSpanItem.appendChild(getSetCountSpanBItem(obj));
    return setCountSpanItem;
}

function getSetPriceSpanBItem(obj) {
    let setPriceSpanBItem = document.createElement('b');
    setPriceSpanBItem.textContent = obj.count * obj.cost + ' ₽';
    return setPriceSpanBItem;
}

function getSetPriceSpanItem(obj) {
    let setPriceSpanItem = document.createElement('span');
    setPriceSpanItem.textContent = 'Итого: ';
    setPriceSpanItem.appendChild(getSetPriceSpanBItem(obj));
    return setPriceSpanItem;
}

function getSetCountItem(obj) {
    let setCountItem = document.createElement('div');
    setCountItem.classList.add('set-count');
    setCountItem.appendChild(getSetCountSpanItem(obj));
    return setCountItem
}

function getSetPriceItem(obj) {
    let setPriceItem = document.createElement('div');
    setPriceItem.classList.add('set-price');
    setPriceItem.appendChild(getSetPriceSpanItem(obj));
    return setPriceItem;
}

function getBtnBuyItem(obj){
    let btnBuyItem = document.createElement('a');
    btnBuyItem.classList.add('btn', 'cart-btn-buy');
    btnBuyItem.dataset.id = obj.id;
    btnBuyItem.href = '/buy/'+obj.id;
    btnBuyItem.textContent = 'Купить';
    return btnBuyItem;
}

function getBtnRemoveItem(obj) {
    let btnRemoveItem = document.createElement('a');
    btnRemoveItem.classList.add('btn', 'cart-btn-remove');
    btnRemoveItem.dataset.id = obj.id;
    btnRemoveItem.href = '/remove/'+obj.id;
    btnRemoveItem.textContent = 'Удалить';
    return btnRemoveItem;
}