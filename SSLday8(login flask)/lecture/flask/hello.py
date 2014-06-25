from flask import Flask
from flask import redirect
from flask import render_template
from flask import session

app = Flask(__name__)
app.secret_key = "soccer"

@app.route("/") 


def index():
	# return "test"
	if session.has_key("loggedin"):
		sessname = session["loggedin"]
		return render_template("hello.html", name=sessname)
	else:
		sessname ="na"
		session.pop("loggedin")
		return render_template("hello.html", name=sessname)

@app.route("/name/<name>")

def newname(name=None):
	if name != "eddie":
		return redirect("/")
	else:
		session["loggedin"] = name
		return render_template("hello.html", name = name)
		# return name

if __name__=="__main__":
	app.run()