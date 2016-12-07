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
                   <td valign="top" align="left"><img src="images/logo-16.png" *ngIf="msg.user.level > 0" /> <small>{{ msg.user?.name }}</small><br />
                     <small class="small" title="{{messages.datetime}}">{{msg.textdate}}</small></td>
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
        this.lastDT = + new Date();
        this.handle = setInterval( () => {
          this.update()
        }, 5000);
      },

      send: function(event) {
        this.newMessage = event.srcElement.value;
        $.post('api/chat/', {'message': this.newMessage});
        event.srcElement.value = "";
      },

      update: function() {
        $.get('api/chat/'+this.lastDT).then( (res) => {
          res = JSON.parse(res)
          for(var i in res) {
            this.messages.unshift(res[i]);
          }
        });
        this.lastDT = + new Date();
      }
    });
  })(window.app || (window.app = {}));
