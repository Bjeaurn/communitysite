(function(app) {
  app.AppComponent =
    ng.core.Component({
      selector: 'chat',
      template: `<table class="table table-condensed">
                  <tr *ngIf="user">
                    <td colspan="2">
                      <input type="text" #chat name="Chat" class="form-control" (keyup.enter)="send($event)" id="ChatMessage" placeholder="Leave a message, press enter." />
                    </td>
                  </tr>
                  <tr *ngFor="let msg of messages">
                   <td valign="top" align="left"><img src="images/logo-16.png" /> {{ msg.user?.name }}<br />
                     <small title="{{messages.datetime}}">{{msg.datetime}}</small></td>
                   <td valign="top">{{msg.body}}</td>
                  </tr>
                </table>`
    })
    .Class({
      constructor: function() {
        this.newMessage = "";
        if(window.chat) {
          this.messages = window.chat;
        } else {
          this.messages = []
        }

        if(window.user) {
          this.user = window.user;
        }
      },

      send: function(event) {
        console.log(event.srcElement.value);
      }
    });
  })(window.app || (window.app = {}));
