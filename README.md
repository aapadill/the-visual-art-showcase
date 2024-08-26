
# The Visual Art Showcase (CRUD Web-app)

The Visual Art Showcase is a web app dedicated to bring emerging artists into the spotlight by providing a digital space for them to display their work, the main goal is to connect artists with art enthusiasts, no matter anyone's background, enabling users to explore a diverse range of artworks, follow their favorite artists, and stay updated with weekly showcases.

## Features

- **Artists and Artworks**: Users can discover artists and view detailed information about their artworks, including images, titles, and descriptions.
- **Weekly Showcases**: Every week, a new artist is featured, highlighting their best works and offering insights into their creative process.
- **User Interaction**: Visitors can like their favorite artworks, follow artists, and subscribe to updates.
- **User Accounts**: Visitors can register for user accounts, allowing them to interact more deeply with the platform, such as liking artworks and following artists.
- **Responsive Design**: Built with Bootstrap, the platform is fully responsive and accessible on any device.

## Technologies

- **Backend**: PHP (MVC architecture)
- **Frontend**: HTML, CSS (Bootstrap), JavaScript
- **Database**: MySQL

## Get started

### Visit the page

- The page is currently hosted in a personal domain: www.deblish.com/Final/Vistas/
- Up to this point it is possible to register, give likes to artwork, subscribe to the page and admin your own profile.
- Future updates will include comments, follows to artists, role changes, administration of users, artworks and more.
- If you're interested in testing a user but without creating an account, please try with:
- User: **github-test** Password: **github-test**

### Installation

- If you're interested in testing it locally or in your own server:

1. Clone the repository to your local directory:
    ```
    git clone https://github.com/deblish/visual-art-showcase
    ```
2. Copy the /Final folder in your public-html or htdocs directory
    ```
    cp ~/visual-art-showcase/Final ~/htdocs/
    ```
3. Create a MySQL database and import the `VisualArtShowcaseDB.sql` file.
4. Configure your database connection in `Modelos/Conexion.php`.
5. Start your local PHP server:
    ```
    php -S localhost:8000
    ```
6. Open your browser and navigate to `http://localhost:8000` to view the project.

## Contributing

Not taking contributions for the Visual Art Showcase currently, but when possible, [CONTRIBUTING.md](CONTRIBUTING.md) will have the guidelines on how to make them.
