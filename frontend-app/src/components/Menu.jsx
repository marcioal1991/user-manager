import * as React from "react";
import {Link} from "react-router-dom";
import {
    Divider,
    Drawer as MuiDrawer,
    IconButton,
    List,
    ListItemButton,
    ListItemIcon,
    styled,
    Toolbar
} from "@mui/material";
import LinkMui from '@mui/material/Link';
import DashboardIcon from '@mui/icons-material/Dashboard';
import PeopleIcon from '@mui/icons-material/People';
import {ChevronLeft} from "@mui/icons-material";

const Drawer = styled(MuiDrawer, { shouldForwardProp: (prop) => prop !== 'open' })(
    ({ theme, open }) => ({
        '& .MuiDrawer-paper': {
            position: 'relative',
            whiteSpace: 'nowrap',
            width: 240,
            transition: theme.transitions.create('width', {
                easing: theme.transitions.easing.sharp,
                duration: theme.transitions.duration.enteringScreen,
            }),
            boxSizing: 'border-box',
            ...(!open && {

                transition: theme.transitions.create('width', {
                    easing: theme.transitions.easing.sharp,
                    duration: theme.transitions.duration.leavingScreen,
                }),
                width: theme.spacing(7),
                [theme.breakpoints.up('sm')]: {
                    width: theme.spacing(9),
                },
            }),
        },
    }),
);

export default function Menu({ open, callback }) {

    return (
        <Drawer variant="permanent" open={open}>
            <Toolbar
                sx={{
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'flex-end',
                }}
            >
                <img src="/logo.png" alt="Logo" loading="eager" height="50px" />
                <IconButton onClick={callback}>
                    <ChevronLeft />
                </IconButton>
            </Toolbar>
            <Divider />
            <List component="nav">
                <ListItemButton>
                    <ListItemIcon>
                        <DashboardIcon/>
                    </ListItemIcon>

                    <LinkMui underline="none" color={"inherit"} sx={{ fontWeight: 'medium' }} component={Link} to="/dashboard">
                        Dashboard
                    </LinkMui>
                </ListItemButton>

                <ListItemButton>
                    <ListItemIcon>
                        <PeopleIcon />
                    </ListItemIcon>
                    <LinkMui underline="none" color={"inherit"} sx={{ fontWeight: 'medium' }} component={Link} to="/users">
                        User management
                    </LinkMui>
                </ListItemButton>
            </List>
            <Divider/>
        </Drawer>
    )
}
