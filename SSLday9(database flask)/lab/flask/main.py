from flask import Flask 
from flask import redirect
from flask import request
from flask import render_template
from flask import session
import mysql.connector

#use flask namespace to initialze
app = Flask(__name__)
#app secret key needed
app.secret_key="joe"

@app.route("/")
def index():
	#connect to your database
	db = mysql.connector.connect(user="root", password="root", host="127.0.0.1", port="8889", database="fruits")
	cur = db.cursor()
	#select all fruits to display
	cur.execute("SELECT id, name, color, quant FROM fruit_table")
	#fetch them all to loop through in the html
	data = cur.fetchall()

	#render the html
	return render_template("index.html", pagedata = data)

@app.route("/addform")
def showform():

	#render add html
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
	cur.execute("INSERT into fruit_table VALUES ('', %s, %s, %s, %s)", (name, color,  quant, storeid))
	db.commit()

	return redirect("/")


@app.route('/edititem', methods = ['GET', 'POST'])
def edititem():
	db = mysql.connector.connect(user='root', password='root', host='127.0.0.1', port = '8889', database='fruits')
	cur = db.cursor()
	id =  request.query_string
	session['id'] = id
	#return session['id']
	cur.execute("select name, color, quant from fruit_table where id = %s", (id,)) 
	data = cur.fetchall()
	return render_template('edit.html', pagedata = data)


@app.route('/update', methods = ['GET', 'POST'])
def update():
	db = mysql.connector.connect(user='root', password='root', host='127.0.0.1', port = '8889', database='fruits')
	cur = db.cursor()
	id =  session['id'] 
	# return id
	fruitname = request.form.get('fruitname')
	color = request.form.get('color')
	quant = request.form.get("quant")
	#return fruitname
	cur.execute("update fruit_table set name=%s, color=%s, quant=%s where id=%s", (fruitname, color, quant, id)) 
	db.commit()
	return redirect('/')


@app.route("/delete")
def delete():
	db = mysql.connector.connect(user="root", password="root", host="127.0.0.1", port="8889", database="fruits")
	cur = db.cursor()

	var = request.query_string


	cur.execute("DELETE FROM fruit_table WHERE id = %s", (var,))
	db.commit()

	return redirect("/")
	# return var

if __name__ == "__main__":
	app.run(debug=True)