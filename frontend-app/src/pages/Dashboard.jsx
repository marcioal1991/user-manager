import {useEffect, useState} from "react";
import axios from "axios";
import ContentWrapper from "../components/ContentWrapper";
import Container from "@mui/material/Container";
import DashboardCard from "../components/DashboardCard";
import {
    ErrorOutlineOutlined,
    PeopleAltOutlined,
    PersonAddAlt1Outlined,
    PersonRemoveAlt1Outlined
} from "@mui/icons-material";

export default function Dashboard() {
    const [activeUsers, setActiveUsers] = useState(0);
    const [newUsers, setNewUsers] = useState(0);
    const [deletedUsers, setDeletedUsers] = useState(0);
    const [inactiveUsers, setInactiveUsers] = useState(0);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        axios.get('/api/users/metrics', {
            params: {
                new_users_days_over: 30,
                inactive_users_days_over: 7,
                deleted_users_days_over: 30,
            },
        })
            .then((response) => {
                setActiveUsers(response.data.data.total_active_users);
                setNewUsers(response.data.data.total_new_users);
                setDeletedUsers(response.data.data.total_deleted_users);
                setInactiveUsers(response.data.data.total_inactive_users);
                setLoading(false);
            })
            .catch(console.log);
    }, []);

    return (
        <ContentWrapper
            menuName={"Dashboard"}
            menuDescription={"Check platform users metrics."}
        >
            <Container sx={{ display: "flex", justifyItems: "center"}}>
                <DashboardCard loading={loading} icon={<PeopleAltOutlined />} textDescription="Total of active users" amount={activeUsers}></DashboardCard>
                <DashboardCard loading={loading} icon={<PersonAddAlt1Outlined />} textDescription="Total of new users in the last 30 days" amount={newUsers}></DashboardCard>
                <DashboardCard loading={loading} icon={<PersonRemoveAlt1Outlined />} textDescription="Total of deleted users in the last 30 days" amount={deletedUsers}></DashboardCard>
                <DashboardCard loading={loading} icon={<ErrorOutlineOutlined />} textDescription="Users inactive for over 7 days" amount={inactiveUsers}></DashboardCard>
            </Container>
        </ContentWrapper>
    )
}
