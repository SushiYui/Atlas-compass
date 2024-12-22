$(function(){
// モーダル表示
$('.edit-modal-open').on('click',function(){
    $('.js-modal').fadeIn();
    var reserve_part = $(this).attr('reserve_data');
    var reserve_day = $(this).attr('value');
    // console.log(reserve_part);

    $('.reserve_part span').text(reserve_part);
    $('.reserve_day span').text(reserve_day);
    return false;
})
$('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });
});
