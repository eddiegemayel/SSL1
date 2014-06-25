from flask import *


app = Flask(__name__)
app.secret_key = 'super secret'

app.config.from_object(__name__)



@app.route('/')
def index():
	if session.has_key('username'):
		# global username
		username=session['username']
		return render_template('profile.html', username=username)
	else:
		return render_template('login.html')

@app.route('/login', methods=['GET', 'POST'])
def login():
	error = None
	if request.method == 'POST':
		if request.form['username'] == 'user' and request.form['password'] == 'pass':
			session['loggedin'] = True
			session['username'] = request.form['username']
			return redirect(url_for('profile'))
		else:
			error = 'fail'
	return render_template('login.html', error=error)
	
@app.route('/profile')
def profile():
	if session.has_key('username'):
		# global username
		username=session['username']
	return render_template('profile.html', username=username)

@app.route('/logout', methods=['GET', 'POST'])
def logout():
	session.pop('loggedin', None)
	return redirect(url_for('/login'))


		
if __name__ == '__main__':
	app.run(debug=True) #if there is any problems with the run function the debug is going to catch it and print on the screen