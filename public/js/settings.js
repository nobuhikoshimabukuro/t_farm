
//Enterキーフォーカス移動
$(document).on("keydown", "input, select", function (e) {
  // $(document).on("keydown", "input, select ,button", function (e) {
    
          
    var code = e.which ? e.which : e.keyCode;
  
    if (code == 13) {
  
      if (e.ctrlKey) {
        
        // Ctrlキーが同時に押されている場合はフォームをサブミット      
        // $(this).closest('form').submit();    
  
      } else {
  
        // body内の指定要素を取得
        var fields = $(this).closest('body').find('input, select, textarea');
        // var fields = $(this).closest('body').find('input, select, textarea,button');
        var total = fields.length;
        var index = fields.index(this);
  
        // ループして次のフォーカス対象を見つける
        for (var i = index + 1; i < total; i++) {
  
          // 特定のクラスがある場合かつdisabledでない場合にフォーカスを移動
          if (!fields.eq(i).hasClass("d-none") && !fields.eq(i).is(":disabled")) {
            fields.eq(i).focus();
            break;
          }
  
        }
  
        return false;
  
      }
  
    }
  
  });


  
// フォーカスでカンマを削除
$(document).on("focus", ".numeric", function (e) {  
  var num = $(this).val().replace(/,/g, '');
  $(this).val(num);
  $(this).select();
});

// フォーカスアウトでカンマを挿入
$(document).on("blur", ".numeric", function (e) {  
  // 入力値を取得
  var numString = $(this).val();

  // 全角数字、全角小数点、全角英字を半角に変換
  numString = fullToHalf(numString);

  // 入力が数字でない場合、何も入力されていない場合
  if (!numString || isNaN(numString)) {
    // 処理中断
    $(this).val(0);
    return;
  }
    
  // 小数点以下が存在する場合としない場合で分岐
  var hasDecimal = numString.indexOf('.') !== -1;

  // 先頭のゼロを無視して数字に変換
  var num = hasDecimal ? parseFloat(numString) : parseInt(numString, 10);

  // 数字に変換後の値を文字列に変換
  var numAsString = num.toString();

  // 変換後の文字列を使用して整数部と小数部に分割
  var parts = numAsString.split('.');
  
  // 整数部を3桁ごとにカンマ挿入
  var integerPart = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');

  // 小数部が存在する場合は整数部と結合し、フォーマット
  var formattedNumber = parts.length > 1 ? integerPart + '.' + parts[1] : integerPart;
  
  // フォーマットされた数値をフィールドに設定
  $(this).val(formattedNumber);
});

// 全角数字、全角小数点、全角英字を半角に変換する関数
function fullToHalf(input) {
  return input.replace(/[０-９．Ａ-Ｚａ-ｚ]/g, function(s) {
    // 文字コードの変換
    return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
  });
}

function end_loader() {

  var elements = document.querySelectorAll('.loader-area');

  // 取得した要素を削除
  elements.forEach(function(element) {
    element.remove();
  });


  var elements = document.querySelectorAll('.loader');

  // 取得した要素を削除
  elements.forEach(function(element) {
    element.remove();
  });
}
  
  // 引数は操作制御したいセレクタ
  function start_processing(target){
  
    // 処理中のローディングcss
    let Html = '<div class="processing-area">';
    Html += '<div class="processing"></div>';
    Html += '</div>';
  
    // 対象要素に作成したhtmlを追加
    $(Html).appendTo(target);
  
  
  }
  
  function end_processing(){   
  
  
    var elements = document.querySelectorAll('.processing-area');
  
    // 取得した要素を削除
    elements.forEach(function(element) {
      element.remove();
    });
  
  
    var elements = document.querySelectorAll('.processing');
  
    // 取得した要素を削除
    elements.forEach(function(element) {
      element.remove();
    });
  
  }


  function error_message_modal_show(error_list){
    //liであること
    $("#error-message-modal .error-list").html('');
    $("#error-message-modal .error-list").html(error_list);
    $('#error-message-modal').modal('show');
  }

  
  function set_used_flg(used_flg){
        

    $('#display_order-area').removeClass('inoperable');
    if(used_flg == 0){
        $('#display_order-area').addClass('inoperable');
    }


    $('#used_flg_0-label').removeClass('used_flg_0-select');
    $('#used_flg_1-label').removeClass('used_flg_1-select');
    $('#used_flg_0-label .used_flg_0-check-mark').remove();
    $('#used_flg_1-label .used_flg_1-check-mark').remove();

  
    $('#used_flg_' + used_flg + '-label').addClass('used_flg_' + used_flg + '-select');
    $('#used_flg_' + used_flg + '-label').append('<div class="used_flg_' + used_flg + '-check-mark"></div>');

    $("#used_flg").val(used_flg);		
}

function set_merchandise_image_used_flg(merchandise_image_used_flg){
        

  $('#display_order-area').removeClass('inoperable');
  
  if(merchandise_image_used_flg == 0){
      $('#display_order-area').addClass('inoperable');
  }


  $('#merchandise_image_used_flg_0-label').removeClass('merchandise_image_used_flg_0-select');
  $('#merchandise_image_used_flg_1-label').removeClass('merchandise_image_used_flg_1-select');
  $('#merchandise_image_used_flg_0-label .merchandise_image_used_flg_0-check-mark').remove();
  $('#merchandise_image_used_flg_1-label .merchandise_image_used_flg_1-check-mark').remove();


  $('#merchandise_image_used_flg_' + merchandise_image_used_flg + '-label').addClass('merchandise_image_used_flg_' + merchandise_image_used_flg + '-select');
  $('#merchandise_image_used_flg_' + merchandise_image_used_flg + '-label').append('<div class="merchandise_image_used_flg_' + merchandise_image_used_flg + '-check-mark"></div>');

  $("#merchandise_image_used_flg").val(merchandise_image_used_flg);		
}


function set_sales_flg(sales_flg){
        
  $('#sales_flg_0-label').removeClass('sales_flg_0-select');
  $('#sales_flg_1-label').removeClass('sales_flg_1-select');
  $('#sales_flg_0-label .sales_flg_0-check-mark').remove();
  $('#sales_flg_1-label .sales_flg_1-check-mark').remove();


  $('#sales_flg_' + sales_flg + '-label').addClass('sales_flg_' + sales_flg + '-select');
  $('#sales_flg_' + sales_flg + '-label').append('<div class="sales_flg_' + sales_flg + '-check-mark"></div>');

  $("#sales_flg").val(sales_flg);		
}


//画面遷移ボタン別タブ
$(document).on("click", ".page-transition-button", function (e) {

  var url = $(this).data('url');
  window.open(url, '_blank');

});

// クリアボタンがクリックされたら
$('#clear-button').click(function(){

    var message = "";
    message += "画面の再読み込みをしても宜しいですか？";
    message += "\n";    
    message += "（入力した項目は保存されません）";

    if(!confirm(message)){     
        return false;
    }

    var current_url = window.location.href;   

    // ページをリロード
    window.location.href = current_url;

});


// 戻るボタンがクリックされたら
$('.page_transition-button').click(function(){

  var process_branch = $(this).data('processbranch');
  var url = $(this).data('url');

  if(process_branch == 1){
    var message = "";
    message += "画面遷移しても宜しいですか？";
    message += "\n";    
    message += "（入力した項目は保存されません）";

    if(!confirm(message)){     
      return false;
    }
  }
  
  window.location.href = url;

});

//モーダルを開いた時の共通イベント
$('.modal').on('show.bs.modal',function(e){  
  $('body').css('overflow-y', 'none');
});

//モーダルを閉じた時の共通イベント
$('.modal').on('hidden.bs.modal', function() {
  $('body').css('overflow-y', 'auto');
});
