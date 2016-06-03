var query = "";
var img_size = "";
var start_index = 0;
var next_index = 0;
var prev_index = 0;

//環境変数をphpから取得
var $script = $('#script');
var gcse_api_key = JSON.parse($script.attr('data-api-key'));
var gcse_id = JSON.parse($script.attr('data-engine-id'));

$().ready(function(){
  $('#next').hide();
  $('#prev').hide();
//検索ボタンをクリックした時
  $('#form').submit(function(){
    QuerySet();
    start_index = 1;
    Search(query, img_size, start_index);
    return false;
  });

//次へボタンをクリックした時
  $('#prev').click(function(){
    QuerySet();
    start_index = prev_index;
    Search(query, img_size, start_index);
    return false;
  });

//前へボタンをクリックした時
  $('#next').click(function(){
    QuerySet();
    start_index = next_index;
    Search(query, img_size, start_index);
    return false;
  });


//画像をクリックした時モーダルで画像を表示
  $(document).on('click', '#modal_up', function(){
    var image_url = $(this).attr('src');
    var page_url = $(this).attr('data-pageUrl');
    console.log(page_url);

    if(!$('.modal-body').children('img').length){
      $('.modal-body').append($("<img/>").attr('src', image_url));
    }else{
      $('.modal-body').children('img').attr('src', image_url);
    }
    $('.modal-footer').html("<p>サイトURL</p><a href=" + page_url + ">" + page_url + "</a>");
  });

//画像にマウスをのせると白くする
  $(document).on({'mouseenter':function(){
    $(this).fadeTo('fast',.3);
  },
 'mouseleave':function(){
    $(this).fadeTo('fast',1);
  }
  },'#modal_up');

});




function QuerySet(){
  query = $('#form').children('input[name=query]').val();
  img_size = $('#form').children('select[name=size]').val();
  if(!query){
    return false;
  }
};


function Search(query, img_size, start_index){
  //現在の検索結果を削除
//これどうしよう？
 $('img').remove();

  //キーワード、サイズ、スタートインデックスで検索
  // -> jsonを取得して画面に表示
  $.ajax({
    type: 'GET',
    url: 'https://www.googleapis.com/customsearch/v1?key=' + gcse_api_key +'&cx=' + gcse_id + '&searchType=image&start=' + start_index + '&q=' + query + img_size,
    dataType: 'jsonp',
    success:function(json){
      var items = json['items'];
      $.each(items, function(index, value){
        var img_url = value['link'];
        var page_url = value['image']['contextLink'];
        console.log(img_url);
        $('#img_field').append($('<img>').attr({src: img_url,id: 'modal_up', class: 'col-lg-3 modalbutton', 'data-toggle': 'modal', 'data-target': '#myModal', 'data-pageUrl': page_url}));
      });

      //「次へ」、「前へ」クリック時のstart_indexを指定
      if(json['queries']['nextPage']){
        next_index = json['queries']['nextPage'][0]['startIndex'];
        $('#next').show();
      }else{
        $('#next').hide();
      }

      if(json['queries']['previousPage']){
        prev_index = json['queries']['previousPage'][0]['startIndex'];
        $('#prev').show();
      }else{
        $('#prev').hide();
      }
    }
  });
};