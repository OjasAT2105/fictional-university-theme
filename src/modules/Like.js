import $ from "jquery";
class Like {
  constructor() {
    this.events();
  }

  events() {
    $(".like-box").on("click", this.ourClickDispatcher.bind(this));
  }

  ourClickDispatcher(e) {
    var currentLikeBox = $(e.target).closest(".like-box"); // this code for selection of like box of user clicked, generally this case is for scenerio in which if the same page has multiple like boxes thats why we are using event to check its closest ones.
    if (currentLikeBox.data("exists") == "yes") {
      this.deleteLike(currentLikeBox);
    } else {
      this.createLike(currentLikeBox);
    }
  }

  createLike(currentLikeBox) {
    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader("X-WP-Nonce", universityData.nonce);
      },
      url: universityData.root_url + "/wp-json/university/v1/manageLike",
      type: "POST",
      data: {
        professorId: currentLikeBox.data("professor"),
      },
      success: (response) => {
        console.log(response);
      },
      error: (response) => {
        console.log(response);
      },
    });
  }

  deleteLike() {
    $.ajax({
      url: universityData.root_url + "/wp-json/university/v1/manageLike",
      type: "DELETE",
      data: {
        professorId: 6,
      },
      success: (response) => {
        console.log(response);
      },
      error: (response) => {
        console.log(response);
      },
    });
  }
}
export default Like;
