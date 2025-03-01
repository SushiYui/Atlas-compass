$(function () {
  $(document).on("click", ".search_conditions", function () {
    $(this).find("span").toggleClass("open");
    $('.search_conditions_inner').slideToggle();
  });

  $('.subject_edit_btn').click(function () {
    $(this).find("span").toggleClass("open");
    $('.subject_inner').slideToggle();
  });
});
