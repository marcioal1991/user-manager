import Box from "@mui/material/Box";
import Menu from "./Menu";
import Header from "./Header";
import {useState} from "react";
import {Container, Grid, Toolbar} from "@mui/material";
import Paper from "@mui/material/Paper";

export default function ContentWrapper({ children, menuName, menuDescription }) {
    const [ open, setOpen ] = useState(true);

    const toggleDrawer = () => {
        setOpen(!open);
    };

    return (
        <>
            <Header open={open} callback={toggleDrawer} menuName={menuName} menuDescription={menuDescription}/>
            <Menu open={open} callback={toggleDrawer} />
            <Box component="main"
                sx={{
                    flexGrow: 1,
                    height: '100vh',
                    overflow: 'auto',
                }}
            >
                <Toolbar />

                <Container maxWidth="lg" sx={{ mt: 4, mb: 4 }}>
                    <Grid item xs={12}>
                        <Paper sx={{ p: 2, display: 'flex', flexDirection: 'column' }}>
                            { children }
                        </Paper>
                    </Grid>
                </Container>
            </Box>
        </>
    )
}
