from flask import Flask 
from flask import redirect
from flask import request
from flask import render_template
from flask import jsonify
import mysql.connector
import json
import urllib

app = Flask(__name__)

@app.route("/")
def index():
	url = "http://localhost:8888/SSLday10/lecture/flask/php/get.php"
	loadurl = urllib.urlopen(url)
	data = json.loads(loadurl.read().decode(loadurl.info().getparam("charset") or "utf-8"))
	item = data[0]["image"]
	#return item
	return render_template("ad.html", hey = item)

# @app.route("/getjson")
# def jsonin():
# 	url = "http://localhost:8888/php/get.php"
# 	loadurl = urllib.urlopen(url)
# 	data = json.loads(loadurl.read().decode(loadurl.info().getparam("charset") or "utf-8"))
# 	item = data[0]
# 	return item

if __name__ == "__main__":
	app.run(debug=True)

	##
	#Python image display
	#<img src="{{url_for('static', filename=data)}}" style="width:100%"
	#
	##