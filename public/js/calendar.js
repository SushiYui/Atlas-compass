$(function(){
// モーダル表示
$('.edit-modal-open').on('click',function(){
    $('.js-modal').fadeIn();
    var reserve_part = $(this).attr('reserve_data');
    var reserve_day = $(this).attr('value');
    // console.log(reserve_part);

    $('.reserve_part span').text(reserve_part);
    $('.reserve_day span').text(reserve_day);

    document.getElementById('reservePart').value = reserve_part;
    document.getElementById('reserveDay').value = reserve_day;

    return false;
})
$('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });

  // モーダル背景をクリックしたときにモーダルを閉じる
$('.js-modal-bg').on('click', function(e){
    // 背背景をリックしたときにモーダルを閉じて、モーダルの中身がクリックされたときは閉じない。
    // もし e.target が modal__content 内部にあれば、その要素を返します。
    if($(e.target).closest('.modal__content').length === 0){
        $('.js-modal').fadeOut();
    }
});
});
