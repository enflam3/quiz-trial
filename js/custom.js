//Show Welcome
$('.start').collapse('show');

//Toggle menu if there is no fast/double clicking clicking
$('.nav a').on('click', function() {
  if ($('.cover-container').find('.collapsing').length === 0) {
    $(this).parent().find('.active').removeClass('active');
    $(this).addClass('active');
  }
});

//Toggle collapsing of divs (showing/hidding elements)
$('.switcher').on('click', function(e) {
  //Check if no animation in progress
  if ($('.cover-container').find('.collapsing').length === 0) {
    //Let it show next step
    let hC = $($(this).attr('data-target')).hasClass("show");
    if (!hC) {
      let $collapse_group = $('.cover-container');
      $collapse_group.find('.collapse.show').collapse('hide');
      $($(this).attr('data-target')).collapse('show');
    }
  }
});

//Generate Choice buttons for specific quiz question
var invoke = function(e) {
  var i;
  for (i = 0; i < e.length; i++) {
    if (i % 2 === 0) {
      $('#choices-left').append('<button type="button" name="choice" class="btn btn-lg btn-primary btn-block choice">' + e[i] + '</button>');
    } else {
      $('#choices-right').append('<button type="button" name="choice" class="btn btn-lg btn-primary btn-block choice">' + e[i] + '</button>');
    }
  }
}

//Required fields ar OK, move on to the quiz
$('#prepare-form').on('submit', function(e) {
  e.preventDefault();
  $('.prepare').collapse('hide');
  $('#choices-left').html('');
  $('#choices-right').html('');
  $.ajax({
    type: 'post',
    url: 'php/hero.php',
    data: $('#prepare-form').serialize(),
    success: function(response) {

      //Get variables from PHP
      let result = $.parseJSON(response);
      
      //if existing user
      let existing = result[7];
      console.log(existing);

      //Set progress variables
      let total = result[2];
      let now = result[3];
      
       if (existing === 'existing') {
        $('.quiz').collapse('hide');
        setTimeout(function() {
          $('.sorry').collapse('show');
        }, 600);
      } else
        {
          
        
        



      if (total == now) {
        let total_points = total * 10;
        let score = result[6];

        //Clear choices
        $('#choices-left').html('');
        $('#choices-right').html('');

        //Set quest info
        $('#questing').html('');
        $('#question').html('Thank You! <BR>Your score is: ' + score + ' of ' + total_points);

      } else {

        $('#questing').html("Quest " + result[3] + " of " + result[2]);
        $('#question').html(result[4]);

        //If Prepare form filled - call invoke to generate choices
        invoke(result[5]);
        
        //Function to show quiz again after 600ms and advance progress
      setTimeout(function() {
        $('.quiz').collapse('show');
        document.getElementById("progress").style.width = 100 / (total / (now)) + "%";
      }, 600);

      }
      
}
    }
  });
});

$(document).on("click", '.choice', function(e) {
  e.preventDefault();
  $('.quiz').collapse('hide');
  let val = $(this).html();
  $.ajax({
    type: 'POST',
    url: 'php/next.php',
    data: {
      choice: val
    },
    success: function(response) {
      //Get variables from PHP
      let result = $.parseJSON(response);

      //Set progress variables
      let total = result[3];
      let now = result[2];
      
      let clicked = result[0];
      let answer = result[1];

      console.log(answer + ' :AvsC: ' + clicked);

      let finished = result[7];

      //If Quest is over;
      if (now > total) {

        //Displat results after animation
        setTimeout(function() {
          let total_points = total * 10;
          let score = result[6];
          //Clear choices
          $('#choices-left').html('');
          $('#choices-right').html('');

          //Set quest info
          $('#questing').html('');
          $('#question').html('Thank You!<BR>Your score is: ' + score + ' of ' + total_points);

        }, 600);

      } else {

        //Set quest info
        $('#questing').html("Quest " + result[2] + " of " + result[3]);
        $('#question').html(result[4]);

        //Clear choices
        $('#choices-left').html('');
        $('#choices-right').html('');

        //Generate new choices for current question
        invoke(result[5]);

      }

      //Function to show quiz again after 600ms and advance progress
      setTimeout(function() {
        $('.quiz').collapse('show');
        document.getElementById("progress").style.width = 100 / (total / (now - 1)) + "%";
      }, 600);

    }
  });
});

$(document).on("click", '.login', function(e) {
  e.preventDefault();
  $.ajax({
    type: 'post',
    url: 'php/admin.php',
    data: $('#admin-signin').serialize(),
    success: function(response) {
      console.log(response);

      if (response === 'seems legit') {
        //Clear choices
        $('#inputAdmin').val('');
        $('#inputPassword').val('');

        $('.admin').collapse('hide');

        setTimeout(function() {
          $('.crud').collapse('show');
        }, 600);


      }
    }

  });
});

$("#inputAdmin").keyup(function(event) {
  if (event.keyCode === 13) {
    $("#admin-btn").click();
  }
});

$("#inputPassword").keyup(function(event) {
  if (event.keyCode === 13) {
    $("#admin-btn").click();
  }
});