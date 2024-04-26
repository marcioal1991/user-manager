import {VisibilityOff} from "@mui/icons-material";
import Typography from "@mui/material/Typography";

export default function NoPermission() {
    return (
        <>
            <Typography>
                <VisibilityOff sx={{ width: 50, height: 50 }}></VisibilityOff>
            </Typography>

            <Typography>
                Only admins have permission to view.
            </Typography>
        </>
    )
}
