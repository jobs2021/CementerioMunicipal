from flask import Flask,request,render_template
from flask_socketio import SocketIO, send
import json

#setup
host='192.168.1.3'
port='8585'
#

app = Flask(__name__)
app.config['SECRET_KEY']="abcde12345"
socketio = SocketIO(app)

@app.route("/")
def index():
	return render_template('index.html')

@app.route("/send_noti")
def send_noti():
	msj = request.args.get("sms")
	socketio.send(json.dumps({'msj' : msj}))
	return msj


@socketio.on('connect')
def on_con():
	print("dentrooo")


if __name__ == "__main__":
	socketio.run(app,debug=True,host=host,port=port)
