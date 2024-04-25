import {Backdrop, CircularProgress} from "@mui/material";

export default function Loading({ loading }) {
    return (
        <Backdrop
            sx={{ color: '#fff', zIndex: (theme) => theme.zIndex.drawer + 1 }}
            open={loading}
        >
            <div><CircularProgress color="white" disableShrink /></div>
        </Backdrop>
    )
}
