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
      this.deleteLike();
    } else {
      this.createLike();
    }
  }

  createLike() {
    alert("create");
  }

  deleteLike() {
    alert("delete");
  }
}
export default Like;
