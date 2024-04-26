import {AppBar as MuiAppBar, IconButton, styled, Toolbar} from "@mui/material";
import Typography from "@mui/material/Typography";
import {Logout, Menu as MenuIcon} from "@mui/icons-material";
import Box from "@mui/material/Box";
import Button from "@mui/material/Button";
import {useNavigate} from "react-router";
import axios from "axios";


const AppBar = styled(MuiAppBar, {
    shouldForwardProp: (prop) => prop !== 'open',
})(({ theme, open }) => ({
    zIndex: theme.zIndex.drawer + 1,
    transition: theme.transitions.create(['width', 'margin'], {
        easing: theme.transitions.easing.sharp,
        duration: theme.transitions.duration.leavingScreen,
    }),
    ...(open && {
        marginLeft: 240,
        width: `calc(100% - ${240}px)`,
        transition: theme.transitions.create(['width', 'margin'], {
            easing: theme.transitions.easing.sharp,
            duration: theme.transitions.duration.enteringScreen,
        }),
    }),
}));

export default function Header({ open, callback, menuName, menuDescription }) {
    const navigate = useNavigate();
    const handleLogout = () => {
        axios.post('/api/logout').then(() => {
           navigate('/');
        });
    }
    return (
        <AppBar position="absolute" open={open}>
            <Toolbar
                sx={{
                    pr: '24px',
                }}
            >
                <IconButton
                    edge="start"
                    color="inherit"
                    aria-label="open drawer"
                    onClick={callback}
                    sx={{
                        marginRight: '36px',
                        ...(open && { display: 'none' }),
                    }}
                >
                    <MenuIcon />
                </IconButton>
                <Box>
                    <Typography
                        component="span"
                        variant="h6"
                        color="inherit"
                        noWrap
                        sx={{ display: 'block' }}
                    >
                        { menuName }
                    </Typography>
                    <Typography
                        component="span"
                        color="inherit"
                        noWrap>
                        { menuDescription }
                    </Typography>
                </Box>
                <Button color="primary" variant="outline" onClick={handleLogout} sx={{ marginLeft: "auto", justifyContent: 'flex-end' }}>
                    Logout
                    <Logout sx={{ marginLeft: '10px'}} />
                </Button>
            </Toolbar>
        </AppBar>
    )
}
