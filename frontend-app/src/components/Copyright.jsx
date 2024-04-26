import Typography from "@mui/material/Typography";
import Link from "@mui/material/Link";
import Box from "@mui/material/Box";


export default function Copyright() {
    return (
        <Box sx={{ position: 'fixed', left: 0, right: 0, bottom: 4}}>
            <Typography variant="body2" color="text.secondary" align="center">
                {'Copyright © '}
                <Link color="inherit" href="http://localhost/">
                    Logoipsum
                </Link>{' '}
                {new Date().getFullYear()}
                {'.'}
            </Typography>
        </Box>
    );
}

