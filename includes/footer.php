</main>
    <footer>
        <p>&copy; desarrollo de sistemas</p>
    </footer>
    <?php
    // Cerrar conexión
    if (isset($conn)) {
        $conn->close();
    }
    ?>
</body>
</html>
