<?php
class Layouts {

    /** HEADER **/
    public function header($conf) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title><?php echo htmlspecialchars($conf['site_name'] ?? 'My Website'); ?></title>

            <!-- Bootstrap core -->
            <link href="<?php echo $conf['site_url'] ?? ''; ?>/css/bootstrap.min.css" rel="stylesheet"
                  onerror="this.href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css'">

            <!-- Unique Custom Styles -->
            <style>
                body {
                    background: #121212;
                    color: #eaeaea;
                    font-family: "Poppins", Arial, sans-serif;
                }
                .navbar {
                    background: linear-gradient(90deg, #ff4b1f, #1fddff);
                    border-radius: 12px;
                    margin-bottom: 1rem;
                }
                .navbar .nav-link {
                    color: #fff !important;
                    font-weight: 600;
                    transition: transform 0.2s;
                }
                .navbar .nav-link:hover {
                    transform: scale(1.1);
                    color: #000 !important;
                }
                .banner {
                    background: #222;
                    color: #fff;
                    border: 2px solid #ff4b1f;
                    padding: 3rem;
                    border-radius: 20px;
                    text-align: center;
                }
                .banner h1 {
                    font-size: 2.5rem;
                    font-weight: bold;
                    color: #1fddff;
                }
                .banner p {
                    font-size: 1.2rem;
                    margin-bottom: 1rem;
                }
                .btn-custom {
                    background: #ff4b1f;
                    border: none;
                    padding: 0.7rem 1.5rem;
                    border-radius: 25px;
                    color: #fff;
                    font-weight: bold;
                    transition: background 0.3s, transform 0.2s;
                }
                .btn-custom:hover {
                    background: #1fddff;
                    color: #000;
                    transform: translateY(-3px);
                }
                .content-block {
                    background: #1e1e1e;
                    padding: 2rem;
                    border-radius: 15px;
                    border: 1px solid #444;
                    margin-bottom: 1.5rem;
                    transition: transform 0.3s ease-in-out;
                }
                .content-block:hover {
                    transform: translateY(-5px);
                    border-color: #ff4b1f;
                }
                footer {
                    background: #1f1f1f;
                    padding: 1rem;
                    text-align: center;
                    color: #aaa;
                    margin-top: 2rem;
                    border-radius: 10px;
                }
            </style>
        </head>
        <?php
    }

    /** NAVBAR **/
    public function navbar($conf, $links = []) {
        ?>
        <body>
        <main class="container py-4">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand fw-bold text-light" href="./">
                        <?php echo htmlspecialchars($conf['site_name'] ?? 'My Website'); ?>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarMain">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php
                            if (empty($links)) {
                                $links = [
                                    'index.php'   => 'Home',
                                    'signup.php'  => 'Sign Up',
                                    'signin.php'  => 'Sign In'
                                ];
                            }
                            foreach ($links as $file => $label) {
                                $active = (basename($_SERVER['PHP_SELF']) == $file) ? 'active' : '';
                                echo "<li class='nav-item'>
                                        <a class='nav-link {$active}' href='{$file}'>{$label}</a>
                                      </li>";
                            }
                            ?>
                        </ul>
                        <form role="search" class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
                            <button class="btn btn-custom" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        <?php
    }

    /** BANNER **/
    public function banner($conf, $title = null, $subtitle = null, $buttonText = null, $buttonLink = "#") {
        ?>
        <div class="banner my-4">
            <h1><?php echo htmlspecialchars($title ?? "Welcome to " . ($conf['site_name'] ?? 'My Website')); ?></h1>
            <p><?php echo htmlspecialchars($subtitle ?? "A fresh, unique design just for you."); ?></p>
            <?php if ($buttonText): ?>
                <a href="<?php echo $buttonLink; ?>" class="btn-custom"><?php echo htmlspecialchars($buttonText); ?></a>
            <?php endif; ?>
        </div>
        <?php
    }

    /** CONTENT BLOCK **/
    public function contentBlock($title, $text, $btnText = null, $btnLink = "#") {
        ?>
        <div class="col-md-6">
            <div class="content-block">
                <h2 style="color:#1fddff;"><?php echo htmlspecialchars($title); ?></h2>
                <p><?php echo htmlspecialchars($text); ?></p>
                <?php if ($btnText): ?>
                    <a href="<?php echo $btnLink; ?>" class="btn-custom"><?php echo htmlspecialchars($btnText); ?></a>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    /** TWO-COLUMN CONTENT **/
    public function content($conf) {
        ?>
        <div class="row">
            <?php
            $this->contentBlock("Custom Layout",
                "This site uses a dark theme with neon accents. Nothing like default Bootstrap!",
                "See More", "#");
            $this->contentBlock("Unique Buttons",
                "All buttons glow and change color when you hover.",
                "Try It", "#");
            ?>
        </div>
        <?php
    }

    /** FORM CONTENT **/
    public function form_content($conf, $ObjForm, $ObjFncs) {
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="content-block">
                    <?php
                    if (basename($_SERVER['PHP_SELF']) == 'signup.php') {
                        $ObjForm->signup($conf, $ObjFncs);
                    } else {
                        $ObjForm->signin($conf, $ObjFncs);
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <?php
                $this->contentBlock("Why Join?",
                    "Get exclusive access with a modern, unique design experience.",
                    "Join Now", "#");
                ?>
            </div>
        </div>
        <?php
    }

    /** FOOTER **/
    public function footer($conf) {
        ?>
        <footer>
            <p>&copy; <?php echo date("Y") . " " . htmlspecialchars($conf['site_name'] ?? 'My Website'); ?>. All rights reserved.</p>
        </footer>
        </main>
        <script src="<?php echo $conf['site_url'] ?? ''; ?>/js/bootstrap.bundle.min.js"
                onerror="this.src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js'">
        </script>
        </body>
        </html>
        <?php
    }
}
