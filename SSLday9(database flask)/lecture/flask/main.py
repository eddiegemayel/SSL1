from flask import Flask 
from flask import redirect
from flask import request
from flask import render_template
from flask import session
import mysql.connector

#use flask namespace to initialze
app = Flask(__name__)
app.secret_key="joe"

@app.route("/")
def index():

	db = mysql.connector.connect(user="root", password="root", host="127.0.0.1", port="8889", database="fruits")
	cur = db.cursor()
	cur.execute("SELECT name, color, quant FROM fruit_table")
	data = cur.fetchall()

	# for row in data:
	# 	print(row)

	# data = ["apples", "bananas"]
	return render_template("index.html", pagedata = data)

@app.route("/addform")
def showform():
	return render_template("add.html")

@app.route("/addaction", methods=["GET", "POST"])
def addaction():
	db = mysql.connector.connect(user="root", password="root", host="127.0.0.1", port="8889", database="fruits")
	cur = db.cursor()

	name = request.form.get("name")
	color = request.form.get("color")
	storeid = 1
	quant = request.form.get("quant")



	# insert into fruit_table("name", "color", "quant", "storeid") values (%s, %s, %,s, %s)
	cur.execute("INSERT into fruit_table VALUES ('', %s, %s, %s, %s)", (name, color, storeid, quant))
	db.commit()

	return redirect("/")


if __name__ == "__main__":
	app.run(debug=True)