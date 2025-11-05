    document.addEventListener('DOMContentLoaded', () => {
      let buyButton = document.getElementById('buyButton');
      let quantitySelect = document.getElementById('quantity');
      let userId = document.querySelector('input[name="user_id"]').value ;
      let itemId = document.getElementById('item_id').value ;
      let itemPrice = document.getElementById('item_price').value ;

      buyButton.addEventListener('click', () => {
        if(confirm("購入しますか？")){
          checkSessionAndProceed(userId, itemId, itemPrice, quantitySelect.value);
        }
        else{
          alert("購入をキャンセルしました。");
        }
      });

      function checkSessionAndProceed(userId, itemId, itemPrice, quantity){
        fetch('../check_session.php', {method: 'POST'})
        .then(response => {
          // if(!response.ok) throw new Error("サーバー通信エラー");
          return response.json();
        })
        .then(data => {
          if(data.status === 'error'){
            alert(data.message);
          }
          else if(data.status === 'ok'){
            alert("購入情報を確認しました。次に決済情報をご入力ください。");
            promptCardNumberAndProcess(userId, itemId, itemPrice, quantity);
          }
        })
        .catch(error => {
          console.error('通信エラー:', error);
          alert("システムエラーが発生しました。購入処理を中断します。");
        });
      }

      function promptCardNumberAndProcess(userId, itemId, itemPrice, quantity){
        let cardNumber = prompt("カード番号を入力してください:");

        if(cardNumber){
          processPurchase(userId, itemId, itemPrice, quantity, cardNumber);
        }
        else{
          alert("カード番号の入力がキャンセルされました。");
        }
      }

      function processPurchase(userId, itemId, itemPrice, quantity, cardNumber){
        let purchaseData = {
          user_id: userId,
          item_id: itemId,
          price: itemPrice,
          quantity: quantity,
          cardNumber: cardNumber
        };

        fetch('../update_shipping_status.php', {
          method: 'POST',
          headers: {'Content-Type': 'application/json'},
          body: JSON.stringify(purchaseData)
        })
        .then(response => response.json())
        .then(data => {
          if(data.status === 'success'){
            alert(`ご購入ありがとうございます！\n${data.message}`);
          }
          else{
            alert(`購入処理エラー: ${data.message}`);
          }
        })
        .catch(error => {
          console.error('最終通信エラー:', error);
          alert("最終購入処理でシステムエラーが発生しました。");
        });
      }
    });